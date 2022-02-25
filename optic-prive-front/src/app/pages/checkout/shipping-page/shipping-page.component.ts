import { Component, OnInit } from '@angular/core';
import { CartService } from 'src/app/services/cart/cart.service';

@Component({
  selector: 'app-shipping-page',
  templateUrl: './shipping-page.component.html',
  styleUrls: ['./shipping-page.component.scss']
})
export class ShippingPageComponent implements OnInit {

  public products : any = [];
  public grandTotal !: number;
  public productsQuantity !: number;
  shipping = ["0","5","10", "15"];


  constructor(private cartService : CartService) { }

  ngOnInit(): void {
    this.cartService.getProducts()
    .subscribe(res=>{
      this.products = res;
      this.grandTotal = this.cartService.getTotalPrice();
      this.productsQuantity = this.cartService.getProductsQuantity();
    });
  }
}
