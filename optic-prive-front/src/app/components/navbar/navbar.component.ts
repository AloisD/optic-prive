import { Component, OnInit } from '@angular/core';
import { CartService } from 'src/app/services/cart/cart.service';

@Component({
  selector: 'app-navbar',
  templateUrl: './navbar.component.html',
  styleUrls: ['./navbar.component.scss']
})
export class NavbarComponent implements OnInit {

  public totalProduct : number = 0;


  constructor(private cartService : CartService) { }

  ngOnInit(): void {this.cartService.getProducts()
    .subscribe(res=>{
      this.totalProduct = res.length;
    })
  }
}
