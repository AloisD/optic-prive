import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { IAddress } from 'src/app/models/IAddress';

@Injectable({
  providedIn: 'root',
})
export class AddresseService {
  private $url = 'https://localhost:8000/api';

  constructor(private http: HttpClient) {}

  getAddresses(): Observable<IAddress> {
    return this.http.get<IAddress>(`${this.$url}/addresses`);
  }
}