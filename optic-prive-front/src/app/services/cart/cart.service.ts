import { Injectable } from '@angular/core';
import { BehaviorSubject } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class CartService {

  public cartProducts : any =[]
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
    if (product.quantityOrdered >= product.quantity) return;
    if (!this.cartProducts.includes(product)) {
      this.cartProducts.push(product);
    }
    product.quantityOrdered +=1;
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

  deleteCartProduct(product: any){
    console.log(this.cartProducts);             // debug, à supprimer
    console.log(product);                       // debug, à supprimer
    this.cartProducts.map((a:any, index:any)=>{
      if(product.id === a.id){
        this.cartProducts.splice(index,1);
      }
    })
    this.products.next(this.cartProducts);
  }

}
