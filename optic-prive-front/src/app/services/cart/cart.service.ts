import { Injectable } from '@angular/core';
import { BehaviorSubject, findIndex } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class CartService {

  public cartProducts : any[] = [];
  public products = new BehaviorSubject<any>([]);

  constructor() { }

  getProducts(){
    return this.products.asObservable();
  }

  setProduct(product : any){
    this.cartProducts.push(...product);
    this.products.next(product);
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
    this.products.next(this.cartProducts);
  }

  removeFromCart(product : any){
    if (this.cartProducts.includes(product)) {
      if (product.quantityOrdered == 1) {
        this.deleteCartProduct(product);
        return;
      } else {
        product.quantityOrdered -=1;
      }
      this.getTotalPrice();
      this.products.next(this.cartProducts);
    } else {
      console.error("not in the cart");
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
