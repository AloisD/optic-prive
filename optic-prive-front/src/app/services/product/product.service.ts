import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { IProduct } from 'src/app/models/IProduct';

@Injectable({
  providedIn: 'root',
})
export class ProductService {
  private $url = 'https://localhost:8000/api';

  constructor(private http: HttpClient) {}

  getProducts(): Observable<IProduct> {
    return this.http.get<IProduct>(`${this.$url}/products`);
  }

  getLatestProducts(): Observable<IProduct> {
    return this.http.get<IProduct>(`${this.$url}/products?page=1&itemsPerPage=3&order%5BcreatedAt%5D=desc`); // on peut changer ici les paramètres de tri, d'ordre, de nombre d'items et de numéro de page
  }

  getProductsBySegment(segmentName: string | undefined): Observable<IProduct> {
    return this.http.get<IProduct>(`${this.$url}/segments/${segmentName}/products?page=1`); // remonte la première page, changer le numéro pour afficher une autre page
  }
}
