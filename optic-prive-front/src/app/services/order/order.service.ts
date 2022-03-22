import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { IOrder } from 'src/app/models/IOrder';

@Injectable({
  providedIn: 'root',
})
export class OrderService {
  private $url = 'https://localhost:8000/api';

  constructor(private http: HttpClient) {}

  getOrdersBySeller(sellerId: number): Observable<IOrder> {
    return this.http.get<IOrder>(
      `${this.$url}/orders?page=1&buyer=${sellerId}`
    );
  }

  /*
  getProductsBySegment(segmentName: string | undefined): Observable<IProduct> {
    return this.http.get<IProduct>(
      `${this.$url}/segments/${segmentName}/products?page=1`
    ); // remonte la première page, changer le numéro pour afficher une autre page
  }
  */
}
