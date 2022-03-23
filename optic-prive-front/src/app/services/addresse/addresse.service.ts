import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { IAddress } from 'src/app/models/IAddress';
import { environment } from 'src/environments/environment';

@Injectable({
  providedIn: 'root',
})
export class AddresseService {
  public apiUrl = `${environment.apiUrl}/api`;

  constructor(private http: HttpClient) {}

  getAddresses(): Observable<IAddress> {
    return this.http.get<IAddress>(`${this.apiUrl}/addresses`);
  }

  getAddressesByUser(userId: number): Observable<IAddress> {
    return this.http.get<IAddress>(
      `${this.apiUrl}/addresses?page=1&user=${userId}`
    );
  }

  createdAddress(address: any): Observable<IAddress> {
    return this.http.post<IAddress>(
      `${this.$url}/addresses`,address
    );
  }
}
