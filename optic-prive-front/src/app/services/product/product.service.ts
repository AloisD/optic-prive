import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { IProduct } from 'src/app/models/IProduct';
import { environment } from 'src/environments/environment';

@Injectable({
  providedIn: 'root',
})
export class ProductService {
  private apiUrl = `${environment.apiUrl}/api`;

  constructor(private http: HttpClient) {}

  getProducts(): Observable<IProduct> {
    return this.http.get<IProduct>(`${this.apiUrl}/products`);
  }

  getLatestProducts(page: number = 1): Observable<IProduct> {
    return this.http.get<IProduct>(
      `${this.apiUrl}/products?page=${page}&itemsPerPage=3&order%5BcreatedAt%5D=desc`
    ); // on peut changer ici les paramètres de tri, d'ordre, de nombre d'items et de numéro de page
  }

  getTopDeals(): Observable<IProduct> {
    return this.http.get<IProduct>(`${this.apiUrl}/products?page=1&itemsPerPage=12&order%5Bselling_price%5D=asc`); // on peut changer ici les paramètres de tri, d'ordre, de nombre d'items et de numéro de page
  }

  getProductsBySegment(segmentName: string | undefined): Observable<IProduct> {
    return this.http.get<IProduct>(
      `${this.apiUrl}/segments/${segmentName}/products?page=1`
    ); // remonte la première page, changer le numéro pour afficher une autre page
  }

  getProduct(id: number): Observable<IProduct> {
    return this.http.get<IProduct>(`${this.apiUrl}/products/${id}`);
  }

  getLatestProductsByUrl(url: string): Observable<IProduct> {
    return this.http.get<IProduct>(`https://localhost:8000${url}`);
  }
}
