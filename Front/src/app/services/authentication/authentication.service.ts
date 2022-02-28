import {
  HttpClient,
  HttpHeaders,
  HttpParams,
  HttpParamsOptions,
} from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { IUser } from 'src/app/models/IUser';

@Injectable({
  providedIn: 'root',
})
export class AuthenticationService {
  constructor(private http: HttpClient) {}

  authentication(user: any) {
    return this.http.post('https://localhost:8000/authentication_token', user, {
      withCredentials: true,
    });
  }

  products() {
    let httpHeaders = new HttpHeaders({
      'Content-Type': 'application/json',
      Accept: 'application/json',
    });

    let options = {
      headers: httpHeaders,
    };
    return this.http.get('https://localhost:8000/api/products', options);
  }

  me() {
    return this.http.get<any>('https://localhost:8000/api/me', {
      withCredentials: true,
    });
  }
}
