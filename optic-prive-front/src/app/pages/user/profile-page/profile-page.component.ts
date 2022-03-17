import { Component, OnInit } from '@angular/core';
import { NgForm } from '@angular/forms';
import { ActivatedRoute, Params, Router } from '@angular/router';
import { IUser } from 'src/app/models/IUser';
import { AddresseService } from 'src/app/services/addresse/addresse.service';
import { AuthenticationService } from 'src/app/services/authentication/authentication.service';
import { ToastService } from 'src/app/services/toast/toast.service';

@Component({
  selector: 'app-profile-page',
  templateUrl: './profile-page.component.html',
  styleUrls: ['./profile-page.component.scss'],
})
export class ProfilePageComponent implements OnInit {
  public userRecover!: any;
  public userFromBDD!: IUser;
  private idLocalStorage!: number | null;
  public addresses!: any;

  constructor(
    private activatedRoute: ActivatedRoute,
    private authenticationService: AuthenticationService,
    private router: Router,
    private toastService: ToastService,
    private addresseService: AddresseService
  ) {}

  ngOnInit(): void {
    if (!this.isAuthorized()) {
      this.router.navigate(['404']);
    } else {
      if (this.idLocalStorage) {
        this.authenticationService
          .getUser(this.idLocalStorage)
          .subscribe((user: IUser) => {
            this.userFromBDD = user;
            this.welcome(this.userFromBDD.username);

            this.addresseService.getAddresses().subscribe((addresses: any) => {
              this.addresses = addresses['hydra:member'];
            });
          });
      }
    }
  }

  isAuthorized(): boolean {
    let authorized = false;
    this.idLocalStorage = this.authenticationService.getUserId();
    if (!this.idLocalStorage) {
      authorized = false;
    }
    authorized = true;

    return authorized;
  }

  welcome(username: string) {
    this.toastService.show(`Bienvenue ${username}`, {
      classname: 'bg-info text-light',
      delay: 3000,
    });
  }

  updateSuccess() {
    this.toastService.show('Mise à jour effectuée', {
      classname: 'bg-info text-light',
      delay: 3000,
    });
  }

  update(updateForm: NgForm) {
    this.authenticationService
      .update(this.idLocalStorage, this.userFromBDD)
      .subscribe((user) => {
        this.updateSuccess();
      });
  }
}
