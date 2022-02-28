import { Component, OnInit } from '@angular/core';
import { IUser } from 'models/IUser';
import { User } from 'models/User';
import { AuthenticationService } from 'src/app/services/authentication/authentication.service';
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
  model: User = new User();
  private userConnected!: IUser;
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
  }

  login() {
    this.authenticationService.authentication(this.user).subscribe(
      () => {
        this.authenticationService.me().subscribe((responseMe) => {
          this.userConnected = responseMe;
          alert(`Hello ${this.userConnected.username}`);
          console.log('UserConnected:', this.userConnected);
          this.showSuccess(`Hello ${this.userConnected.username}`);
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
    console.log('showSuccess message', message);

    this.toastService.show(message, {
      classname: 'bg-success text-light',
      delay: 10000,
    });
  }

  showError() {
    this.toastService.show('La connexion a échouée', {
      classname: 'bg-danger text-light',
      delay: 5000,
    });
  }
}
