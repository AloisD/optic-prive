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

  addtoCart(product : any){
    if (this.cartProducts.includes(product)) {
      product.quantityOrdered +=1;
      return;
    }
    this.cartProducts.push(product);
    product.quantityOrdered +=1;
    this.products.next(this.cartProducts);
    this.getTotalPrice();
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


  removeCartProduct(product: any){
    this.cartProducts.map((a:any, index:any)=>{
      if(product.id === a.id){
        this.cartProducts.splice(index,1);
      }
    })
    this.products.next(this.cartProducts);
  }

}
