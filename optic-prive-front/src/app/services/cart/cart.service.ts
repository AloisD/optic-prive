import { Injectable, Inject, PLATFORM_ID } from '@angular/core';
import { IProduct } from 'src/app/models/IProduct';
import { BehaviorSubject } from 'rxjs';
import { isPlatformBrowser } from '@angular/common';
import { ToastService } from 'src/app/services/toast/toast.service';
import { IShippingOption } from 'src/app/models/IShippingOption';
export interface CartProduct extends IProduct {
  quantityOrdered: number;
}

@Injectable({
  providedIn: 'root',
})

export class CartService {
  private price: number = 0;
  public priceShipping = {
    id: 0,
    price: 0,
  };
  public cartProducts: CartProduct[] = [];
  public cartShippingOptions: any;
  public products = new BehaviorSubject<CartProduct[]>([]);
  public shippingOption = new BehaviorSubject<IShippingOption[]>([]);

  constructor(@Inject(PLATFORM_ID) private platformId: Object, private toastService: ToastService) {
    if (isPlatformBrowser(this.platformId)) {
      const cartStorage = localStorage.getItem('cart');
      if (cartStorage) {
        this.products.next(JSON.parse(cartStorage));
      }
      const shippingStorage = localStorage.getItem('shipping-price');
      if (shippingStorage) {
        this.shippingOption.next(JSON.parse(shippingStorage));
      }
      this.products.subscribe((products) => {
        this.cartProducts = products;
        localStorage.setItem('cart', JSON.stringify(products));
      });
      this.shippingOption.subscribe((shippingOption) => {
        this.cartShippingOptions = shippingOption;
        localStorage.setItem('shipping-price', JSON.stringify(shippingOption));
      });
    }
  }

  getProducts() {
    return this.products.asObservable();
  }

  addToCart(product: CartProduct) {
    let newCartProducts: CartProduct[] = [];
    const currentIndex = this.cartProducts.findIndex((currentProduct) => {
      return currentProduct.id === product.id;
    });
    if (currentIndex === -1) {
      product.quantityOrdered = 1;
      newCartProducts = [...this.cartProducts, product];
    } else {
      if (this.cartProducts[currentIndex].quantityOrdered >= product.quantity) return;

      newCartProducts = [...this.cartProducts];
      newCartProducts[currentIndex].quantityOrdered += 1;
    }
    this.toastService.show(`Votre article a bien été ajouté au panier`, {
      delay: 2000,
      classname: 'bg-success text-light',
    });
    this.products.next(newCartProducts);
  }

  removeFromCart(product: CartProduct) {
    const currentIndex = this.cartProducts.findIndex((currentProduct) => {
      return currentProduct.id === product.id;
    });

    if (currentIndex === -1) {
      console.error('not in the cart');
      return;
    }

    if (this.cartProducts[currentIndex].quantityOrdered === 1) {
      this.deleteCartProduct(product);
      return;
    }

    let newCartProducts: CartProduct[] = [];
    newCartProducts = [...this.cartProducts];
    newCartProducts[currentIndex].quantityOrdered -= 1;
    this.products.next(newCartProducts);
  }

  getTotalPrice(): number {
    return this.cartProducts.reduce((grandTotal, currentProduct) => {
      return (
        grandTotal +
        currentProduct.selling_price * currentProduct.quantityOrdered
      );
    }, 0);
  }

  getProductsQuantity(): number {
    return this.cartProducts.reduce((productsQuantity, currentProduct) => {
      return productsQuantity + currentProduct.quantityOrdered;
    }, 0);
  }

  deleteCartProduct(product: CartProduct) {
    const newCartProducts = this.cartProducts.filter((currentProduct) => {
      return currentProduct.id !== product.id;
    });
    this.products.next(newCartProducts);
  }

  setPrice(value: number) {
    this.price = value;
  }

  getPrice() {
    return this.price;
  }

  setShippingPrice(newShippingOption: any) {
    this.shippingOption.next(newShippingOption);
  }

  getShippingPrice() {
    return this.priceShipping;
  }

  getShippingPrice1() {
    return this.priceShipping.price;
  }

  getShippingPriceId() {
    return this.priceShipping.id;
  }
}
