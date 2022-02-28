import { Component, OnInit } from '@angular/core';
import { IProduct } from 'src/app/models/IProduct';
import { CartService } from 'src/app/services/cart/cart.service';
import { ProductService } from 'src/app/services/product/product.service';
@Component({
  selector: 'app-home-page',
  templateUrl: './home-page.component.html',
  styleUrls: ['./home-page.component.scss'],
})
export class HomePageComponent implements OnInit {
  products!: [IProduct];

  constructor(
    private productService: ProductService,
    private cartService: CartService
  ) {}
  ngOnInit(): void {
    this.productService.getProducts().subscribe((datas: any) => {
      this.products = datas['hydra:member'];

      this.products.forEach((product: any) => {
        Object.assign(product, { quantityOrdered: 0 });
      });
    });
  }

  addtocart(product: any) {
    this.cartService.addToCart(product);
  }
}
