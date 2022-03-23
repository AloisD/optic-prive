import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { IOrder } from 'src/app/models/IOrder';
import { environment } from 'src/environments/environment';

@Injectable({
  providedIn: 'root',
})
export class OrderService {
  public apiUrl = `${environment.apiUrl}/api`;

  constructor(private http: HttpClient) {}

  getOrdersBySeller(sellerId: number): Observable<IOrder> {
    return this.http.get<IOrder>(
      `${this.apiUrl}/orders?page=1&buyer=${sellerId}`
    );
  }

  /*
  getProductsBySegment(segmentName: string | undefined): Observable<IProduct> {
    return this.http.get<IProduct>(
      `${this.apiUrl}/segments/${segmentName}/products?page=1`
    ); // remonte la première page, changer le numéro pour afficher une autre page
  }
  */
}
