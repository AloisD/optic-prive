import { Component, OnInit } from '@angular/core';
import { CartService } from 'src/app/services/cart/cart.service';
import { ShippingOptionService } from 'src/app/services/shipping-option/shipping-option.service';

@Component({
  selector: 'app-final-checkout-page',
  templateUrl: './final-checkout-page.component.html',
  styleUrls: ['./final-checkout-page.component.scss']
})
export class FinalCheckoutPageComponent implements OnInit {
  public products : any = [];
  public grandTotal !: number;
  public productsQuantity !: number;
  public summaryShippingPrice !:number;
  public price !:number;

  constructor(private cartService : CartService, private shippingOptionService :ShippingOptionService) { }

  ngOnInit(): void {
    this.cartService.getProducts()
    .subscribe(res=>{
      this.products = res;
      this.grandTotal = this.cartService.getTotalPrice();
      this.productsQuantity = this.cartService.getProductsQuantity();
      this.price = this.cartService.getPrice();
      console.log('prix',this.price);
    });
    console.log('cartProducts', this.cartService.cartProducts);
  }

  changePriceShipping()
  {
    this.summaryShippingPrice = this.shippingOptionService.shippingPrice;
  }

}

