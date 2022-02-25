import { Component, OnInit } from '@angular/core';
import { CartService } from 'src/app/services/cart/cart.service';

@Component({
  selector: 'app-summary-order-page',
  templateUrl: './summary-order-page.component.html',
  styleUrls: ['./summary-order-page.component.scss']
})
export class SummaryOrderPageComponent implements OnInit {
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
  }
}
