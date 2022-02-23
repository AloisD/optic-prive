import { Component, OnInit } from '@angular/core';
import { CartService } from 'src/app/services/cart/cart.service';


@Component({
  selector: 'app-cart-page',
  templateUrl: './cart-page.component.html',
  styleUrls: ['./cart-page.component.scss']
})
export class CartPageComponent implements OnInit {

  public products : any = [];
  public grandTotal !: number;
  public productsQuantity !: number;

  constructor(private cartService : CartService) { }

  ngOnInit(): void {
    this.cartService.getProducts()
    .subscribe(res=>{
      this.products = res;
      this.grandTotal = this.cartService.getTotalPrice();
      this.productsQuantity = this.cartService.getProductsQuantity();
    });
    console.log(this.products);
  }

  removeItem(product: any){
    this.cartService.deleteCartProduct(product);
  }

  decreaseQuantity(product: any) {
    this.cartService.removeFromCart(product);
  }

  increaseQuantity(product: any) {
    this.cartService.addToCart(product);
  }
}
