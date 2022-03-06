import { Component, OnInit } from '@angular/core';
import { IProduct } from 'src/app/models/IProduct';
import { CartService } from 'src/app/services/cart/cart.service';
import { ProductService } from 'src/app/services/product/product.service';
import { ActivatedRoute, Params } from '@angular/router';

@Component({
  selector: 'app-category-page',
  templateUrl: './category-page.component.html',
  styleUrls: ['./category-page.component.scss']
})
export class CategoryPageComponent implements OnInit {
  products!: [IProduct];
  segmentName: string | undefined;


  constructor(
    private activatedRoute: ActivatedRoute,
    private productService: ProductService,
    private cartService: CartService
  ) {}

  ngOnInit(): void {
/*     const segment_name = this.activatedRoute.snapshot.params['name'];
    console.log('name :: ', segment_name);
    this.productService.getProductsBySegment(segment_name).subscribe((datas: any) => {
      this.products = datas['hydra:member'];
      this.products.forEach((product: any) => {
        Object.assign(product, { quantityOrdered: 0 });
      });
    }); */

    this.activatedRoute.params.subscribe((params: Params) => {
      this.segmentName = params['name'];
      console.log('name :: ', this.segmentName);

      this.productService.getProductsBySegment(this.segmentName).subscribe((datas: any) => {
        this.products = datas['hydra:member'];
        this.products.forEach((product: any) => {
          Object.assign(product, { quantityOrdered: 0 });
       });
      });

    });
  }

  addtocart(product: any) {
    this.cartService.addToCart(product);
  }
}



