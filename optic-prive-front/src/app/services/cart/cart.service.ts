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
    this.cartProducts.push(product);
    this.products.next(this.cartProducts);
    this.getTotalPrice();
    console.log(this.cartProducts)
  }

  getTotalPrice(){
    let grandTotal = 0;
    this.cartProducts.map((a:any)=>{
      grandTotal += a.total;
    })
    return grandTotal;
  }

  removeCartProduct(product: any){
    this.cartProducts.map((a:any, index:any)=>{
      if(product.id=== a.id){
        this.cartProducts.splice(index,1);
      }
    })
    this.products.next(this.cartProducts);
  }

}
