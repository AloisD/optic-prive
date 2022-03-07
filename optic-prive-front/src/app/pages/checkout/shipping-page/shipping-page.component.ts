import { Component, OnInit } from '@angular/core';
import { IShippingOption } from 'src/app/models/IShippingOption';
import { CartService } from 'src/app/services/cart/cart.service';
import { ShippingOptionService } from 'src/app/services/shipping-option/shipping-option.service';

@Component({
  selector: 'app-shipping-page',
  templateUrl: './shipping-page.component.html',
  styleUrls: ['./shipping-page.component.scss']
})
export class ShippingPageComponent implements OnInit {
  shippingOptions!: [IShippingOption];

  public products : any = [];
  public grandTotal !: number;
  public productsQuantity !: number;
  shipping = ["0","5","10", "15"];


  constructor(private cartService : CartService, private shippingOptionService : ShippingOptionService) { }

  ngOnInit(): void {
    this.cartService.getProducts()
    .subscribe(res=>{
      this.products = res;
      this.grandTotal = this.cartService.getTotalPrice();
      this.productsQuantity = this.cartService.getProductsQuantity();
    });

    this.shippingOptionService.getShippingOptions().subscribe((datas: any) => {
      this.shippingOptions = datas['hydra:member'];
      this.shippingOptions.forEach((shippingOption: any) => {
        Object.assign(shippingOption);
      });
    });
  }
}

// getTotalPrice(): number {
//   let grandTotal = 0;
//   this.cartProducts.map((product: any) => {
//     grandTotal += +product.selling_price * product.quantityOrdered;
//   });
//   return grandTotal;
// }
