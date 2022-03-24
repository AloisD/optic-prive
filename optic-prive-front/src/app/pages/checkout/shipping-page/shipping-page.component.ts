import { Component, OnInit } from '@angular/core';
import { FormControl, FormGroup, Validators } from '@angular/forms';
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
  price : number = 0;
  newPrice : number = 0;

  constructor(public cartService : CartService, private shippingOptionService : ShippingOptionService) { }

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

    if (this.cartService.getShippingPrice1()) {
      this.price = this.cartService.getShippingPrice1();
    }
  }

  changeShippingOption(e:any) {
    this.shippingOptionService.getShippingOption(e.target.value).subscribe((s:IShippingOption)=> {
      console.log(s.price);
      this.price = Number(s.price);
      this.shippingOptionService.shippingPrice = this.price;
      this.cartService.setPrice(this.price);
      console.log('id',e.target.value);
      console.log('prix', this.price);
      this.cartService.setShippingPrice({id:Number(e.target.value), price:this.price});
      console.log('total',this.cartService.getShippingPrice());
    })
  }
}


