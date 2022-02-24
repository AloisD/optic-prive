import { Injectable } from '@angular/core';
import { BehaviorSubject, findIndex } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class CartService {

  public cartProducts : any[] = [];
  public products = new BehaviorSubject<any>(null);

  constructor() {
    const cartStorage = localStorage.getItem("cart");
    if (cartStorage) {
      this.products.next(JSON.parse(cartStorage));
      this.cartProducts = JSON.parse(cartStorage);
    }
    this.products.subscribe(products=>{
      localStorage.setItem("cart", JSON.stringify(products));
    });
  }

  getProducts(){
    return this.products.asObservable();
  }

  addToCart(product : any){
    const currentIndex = this.cartProducts.findIndex((currentProduct) => {
      return currentProduct.id === product.id;
    });
    if (product.quantityOrdered >= product.quantity) return;
    if (currentIndex === -1) {
      product.quantityOrdered = 1;
      this.cartProducts.push(product);
    } else {
      this.cartProducts[currentIndex].quantityOrdered +=1;
    }
    this.getTotalPrice();
    this.products.next(this.cartProducts); //this.products.next([...this.cartProducts, product]); code écrit par Michel, ne pas supprimer sans explication de sa part
  }

  removeFromCart(product : any){
    const currentIndex = this.cartProducts.findIndex((currentProduct) => {
      return currentProduct.id === product.id;
    });

    if (currentIndex === -1) {
      console.error("not in the cart");
    } else {
      if (product.quantityOrdered === 1) {
        this.deleteCartProduct(product);
        return;
      } else {
        product.quantityOrdered -=1;
      }
      this.products.next(this.cartProducts);
    }
  }

  getTotalPrice() : number {
    let grandTotal = 0;
    this.cartProducts.map((product: any)=>{
      grandTotal += +product.selling_price * product.quantityOrdered;
    })
    return grandTotal;
  }

  getProductsQuantity() : number {
    let productsQuantity = 0;
    this.cartProducts.map((product: any)=>{
      productsQuantity += +product.quantityOrdered;
    })
    return productsQuantity;
  }

  deleteCartProduct(product: any) {
    this.cartProducts = this.cartProducts.filter((currentProduct) => {
      return currentProduct.id !== product.id;
    })
    this.products.next(this.cartProducts);
  }
}
