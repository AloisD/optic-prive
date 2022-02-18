import { Component, OnInit } from '@angular/core';
import { IProduct } from 'src/app/models/IProduct';
import { CartService } from 'src/app/services/cart/cart.service';
import { ProductService } from 'src/app/services/product/product.service';
@Component({
  selector: 'app-home-page',
  templateUrl: './home-page.component.html',
  styleUrls: ['./home-page.component.scss']
})
export class HomePageComponent implements OnInit {
  products!: [IProduct];

  constructor(private productService: ProductService, private cartService : CartService) { }

  ngOnInit(): void {
    this.productService.getProducts().subscribe((datas: any) => {
      this.products = datas['hydra:member'];
      console.log(this.products);

      this.products.forEach((a:any) => {
        Object.assign(a,{quantity:1,total:a.retail_price});
      });
    })
  }
  addtocart(product: any){
    this.cartService.addtoCart(product);
  }
}

