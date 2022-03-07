import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Params } from '@angular/router';
import { IProduct } from 'src/app/models/IProduct';
import { ProductService } from 'src/app/services/product/product.service';

@Component({
  selector: 'app-product-page',
  templateUrl: './product-page.component.html',
  styleUrls: ['./product-page.component.scss']
})
export class ProductPageComponent implements OnInit {

  product!: IProduct;
  id: number | undefined;

  constructor(
    private activatedRoute: ActivatedRoute,
    private productService: ProductService
   ) {}

  ngOnInit(): void {
    this.activatedRoute.params.subscribe((params: Params) => {
      this.id = params['id'];
    });
    this.productService.getProduct(this.id!).subscribe((currentProduct: IProduct) => {
      this.product = currentProduct;
    });
  }
}
