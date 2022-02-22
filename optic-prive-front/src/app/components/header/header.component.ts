import { Component, OnInit } from '@angular/core';
import { User } from 'src/app/models/User';
import { CartService } from 'src/app/services/cart/cart.service';

@Component({
  selector: 'app-header',
  templateUrl: './header.component.html',
  styleUrls: ['./header.component.scss'],
})
export class HeaderComponent implements OnInit {

  model: User = new User();
  public totalProduct : number = 0;
  public productsQuantity !: number;


  constructor(private cartService : CartService) {}

  ngOnInit(): void {
    this.cartService.getProducts()
    .subscribe(res=>{
      this.totalProduct = res.length;
      this.productsQuantity = this.cartService.getProductsQuantity();
    })
  }

  onSubmit() {
    console.log(this.model);
 }
}
