import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { IProduct } from 'src/app/models/IProduct';
import { ProductService } from 'src/app/services/product/product.service';

@Component({
  selector: 'app-product-page',
  templateUrl: './product-page.component.html',
  styleUrls: ['./product-page.component.scss']
})
export class ProductPageComponent implements OnInit {

  product! : IProduct;
  products!: [IProduct];

  constructor(
    private route: ActivatedRoute,
    private productService: ProductService
   ) { }

  ngOnInit(): void {
    const id = this.route.snapshot.params['id'];
    this.productService.getProduct(id).subscribe(p => this.product = p);

    this.productService.getLatestProducts().subscribe((datas: any) => {
      this.products = datas['hydra:member'];
      this.products.forEach((product: any) => {
        Object.assign(product, { quantityOrdered: 0 });
      });
    });
  }

}
