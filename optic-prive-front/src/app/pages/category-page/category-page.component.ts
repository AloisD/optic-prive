import { Component, OnInit } from '@angular/core';
import { IProduct } from 'src/app/models/IProduct';
import { CartService } from 'src/app/services/cart/cart.service';
import { ProductService } from 'src/app/services/product/product.service';
import { ActivatedRoute } from '@angular/router';

@Component({
  selector: 'app-category-page',
  templateUrl: './category-page.component.html',
  styleUrls: ['./category-page.component.scss']
})
export class CategoryPageComponent implements OnInit {
  products!: [IProduct];

  constructor(
    private route: ActivatedRoute,
    private productService: ProductService,
    private cartService: CartService
  ) {}

  ngOnInit(): void {
    const segment_name = this.route.snapshot.params['name']; //utiliser subscribe, virer snapshot, cf pokédex.
    console.log('name :: ', segment_name);
    this.productService.getProductsBySegment(segment_name).subscribe((datas: any) => {
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



