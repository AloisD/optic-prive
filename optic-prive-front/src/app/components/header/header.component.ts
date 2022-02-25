import { Component, HostListener, OnInit } from '@angular/core';
import { catchError, of } from 'rxjs';
import { IUser } from 'src/app/models/IUser';
import { AuthenticationService } from 'src/app/services/authentication/authentication.service';
import { User } from 'src/app/models/User';
import { CartService } from 'src/app/services/cart/cart.service';
import { ToastService } from 'src/app/services/toast/toast.service';

@Component({
  selector: 'app-header',
  templateUrl: './header.component.html',
  styleUrls: ['./header.component.scss'],
})
export class HeaderComponent implements OnInit {
  public user = {
    email: '',
    password: '8888',
  };
  private userConnected!: IUser;
  model: User = new User();
  public totalProduct: number = 0;
  public productsQuantity!: number;

  constructor(
    private authenticationService: AuthenticationService,
    private cartService: CartService,
    public toastService: ToastService
  ) {}

  ngOnInit(): void {
    this.cartService.getProducts().subscribe((res) => {
      if (res) {
        this.totalProduct = res.length;
      }
      this.productsQuantity = this.cartService.getProductsQuantity();
    });

    this.authenticationService
      .products()
      .subscribe((response) => console.log('Products: ', response));
  }

  login() {
    this.authenticationService.authentication(this.user).subscribe(
      () => {
        this.authenticationService.me().subscribe((responseMe) => {
          this.userConnected = responseMe;
          console.log('UserConnected:', this.userConnected);
          this.showSuccess(`Hello ${this.userConnected.username} `);
        });
      },
      (err) => {
        console.error('Error: ', err);
        this.showError();
      }
    );
  }

  onSubmit() {
    console.log(this.model);
  }

  // Toasts
  showSuccess(message: string) {
    this.toastService.show(message, {
      classname: 'bg-success text-light',
      delay: 5000,
    });
  }

  showError() {
    this.toastService.show('La connexion a échouée', {
      classname: 'bg-danger text-light',
      delay: 5000,
    });
  }
}
