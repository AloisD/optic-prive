import { Component, OnInit } from '@angular/core';
import { IProduct } from 'src/app/models/IProduct';
import { CartService } from 'src/app/services/cart/cart.service';
import { ProductService } from 'src/app/services/product/product.service';
import { environment } from 'src/environments/environment';
import { ToastService } from 'src/app/services/toast/toast.service';
import { reduceEachLeadingCommentRange } from 'typescript';

@Component({
  selector: 'app-home-page',
  templateUrl: './home-page.component.html',
  styleUrls: ['./home-page.component.scss'],
})
export class HomePageComponent implements OnInit {
  public products!: [IProduct];
  public apiUrl = `${environment.apiUrl}`;
  public nextUrl!: string;
  public previousUrl!: string;

  constructor(
    private productService: ProductService,
    private cartService: CartService,
    private toastService: ToastService,
  ) {}

  ngOnInit(): void {
    this.productService.getLatestProducts().subscribe((datas: any) => {
      //console.log('datas :', datas);

      this.products = datas['hydra:member'];
      this.products.forEach((product: any) => {
        Object.assign(product, { quantityOrdered: 0 });
      });
      // For pagination
      this.nextUrl = datas['hydra:view']['hydra:next'];
      this.previousUrl = datas['hydra:view']['hydra:previous'];
    });
  }

  addtocart(product: any) {
    this.cartService.addToCart(product);
    this.toastService.show(`Votre article a bien été ajouté au panier`, {
      delay: 3000,
      classname: 'bg-success text-light',
    });
  }

  goToPreviousPage() {
    this.productService
      .getLatestProductsByUrl(this.previousUrl)
      .subscribe((datas: any) => {
        this.products = datas['hydra:member'];
        this.products.forEach((product: any) => {
          Object.assign(product, { quantityOrdered: 0 });
        });

        // For pagination
        this.nextUrl = datas['hydra:view']['hydra:next'];
        this.previousUrl = datas['hydra:view']['hydra:previous'];
      });
  }

  goToNextPage() {
    console.log('Next url', this.nextUrl);
    this.productService
      .getLatestProductsByUrl(this.nextUrl)
      .subscribe((datas: any) => {
        this.products = datas['hydra:member'];
        this.products.forEach((product: any) => {
          Object.assign(product, { quantityOrdered: 0 });
        });

        // For pagination
        this.nextUrl = datas['hydra:view']['hydra:next'];
        this.previousUrl = datas['hydra:view']['hydra:previous'];
      });
  }
}
