import { Injectable } from '@angular/core';
import { IProduct } from 'src/app/models/IProduct';
import { BehaviorSubject } from 'rxjs';


export interface CartProduct extends IProduct {
  quantityOrdered: number;
}

@Injectable({
  providedIn: 'root',
})
export class CartService {

  private price: number = 0;
  public priceShipping = {
    id:0,
    price:0
  };
  public cartProducts: CartProduct[] = [];
  public products = new BehaviorSubject<CartProduct[]>([]);

  constructor() {
    const cartStorage = localStorage.getItem('cart');
    if (cartStorage) {
      this.products.next(JSON.parse(cartStorage));
    }
    this.products.subscribe((products) => {
      this.cartProducts = products;
      localStorage.setItem('cart', JSON.stringify(products));
    });
  }

  getProducts() {
    return this.products.asObservable();
  }

  addToCart(product: CartProduct) {
    let newCartProducts: CartProduct[] = [];
    const currentIndex = this.cartProducts.findIndex((currentProduct) => {
      return currentProduct.id === product.id;
    });
    if (product.quantityOrdered >= product.quantity) return;
    if (currentIndex === -1) {
      product.quantityOrdered = 1;
      newCartProducts = [...this.cartProducts, product];
    } else {
      newCartProducts = [...this.cartProducts];
      newCartProducts[currentIndex].quantityOrdered += 1;
    }
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
      return grandTotal + currentProduct.selling_price * currentProduct.quantityOrdered;
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

  setPrice (value: number) {
    this.price = value
  }

  getPrice () {
    return this.price;
  }

  setShippingPrice(value: any) {
    this.priceShipping.id = value.id;
    this.priceShipping.price = value.price;
    localStorage.setItem('shipping-price', JSON.stringify(this.priceShipping));
  }

  getShippingPrice() {
    return this.priceShipping;
  }

  getShippingPrice1() {
    return this.priceShipping.price;
  }
}
