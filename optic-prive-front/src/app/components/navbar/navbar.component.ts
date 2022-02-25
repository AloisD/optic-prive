import { Component, OnInit } from '@angular/core';
import { CartService } from 'src/app/services/cart/cart.service';

@Component({
  selector: 'app-navbar',
  templateUrl: './navbar.component.html',
  styleUrls: ['./navbar.component.scss']
})
export class NavbarComponent implements OnInit {

  public productsQuantity !: number;

  constructor(private cartService : CartService) { }

  ngOnInit(): void {this.cartService.getProducts()
    .subscribe(res=>{
      this.productsQuantity = this.cartService.getProductsQuantity();
    })
  }
}
