import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root',
})
export class OrderService {
  private $url = 'https://localhost:8000/api';

  constructor(private http: HttpClient) {}

  /*
  getOrders(): {
    //To implements
  };
  */
}
