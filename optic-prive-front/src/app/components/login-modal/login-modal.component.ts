import { Component, ElementRef, OnInit, ViewChild } from '@angular/core';
import { IUser } from 'src/app/models/IUser';
import { AuthenticationService } from 'src/app/services/authentication/authentication.service';
import { User } from 'src/app/models/User';
import { CartService } from 'src/app/services/cart/cart.service';
import { ToastService } from 'src/app/services/toast/toast.service';
import { NgForm } from '@angular/forms';

@Component({
  selector: 'app-login-modal',
  templateUrl: './login-modal.component.html',
  styleUrls: ['./login-modal.component.scss'],
})
export class LoginModalComponent implements OnInit {
  public user = {
    email: '',
    password: '8888',
  };
  public checkRules = {
    rules: false,
  };
  private userConnected!: IUser;
  model: User = new User();
  public totalProduct: number = 0;
  public productsQuantity!: number;

  //for close register modal
  @ViewChild('elemRegisterClose', { static: true }) elementClose: ElementRef = <
    ElementRef
  >{};

  constructor(
    private authenticationService: AuthenticationService,
    private cartService: CartService,
    private toastService: ToastService
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
          //console.log('UserConnected:', this.userConnected);

          this.showSuccess(this.userConnected.username);
        });
      },
      (err) => {
        console.error('Error: ', err);
        this.showDanger();
      }
    );
  }

  onSubmit() {
    console.log(this.model);
  }

  saveDatas(registerForm: NgForm) {
    this.authenticationService.register(this.model).subscribe(
      () => {
        this.registerSuccess();

        // For close modal
        let el = this.elementClose.nativeElement;
        el?.click();

        //clear fields's form
        registerForm.reset();
      },
      (err) => {
        console.error('Error: ', err);
        this.registerFailed();
      }
    );
  }

  showSuccess(username: string) {
    this.toastService.show(`Hello ${username}`, {
      classname: 'bg-success text-light',
      delay: 5000,
    });
  }

  showDanger() {
    this.toastService.show('La connexion a échouée', {
      classname: 'bg-danger text-light',
      delay: 5000,
    });
  }

  registerSuccess() {
    this.toastService.show(`Inscription effectuée`, {
      classname: 'bg-success text-light',
      delay: 5000,
    });
  }

  registerFailed() {
    this.toastService.show(`Inscription non-effectuée`, {
      classname: 'bg-danger text-light',
      delay: 5000,
    });
  }
}
