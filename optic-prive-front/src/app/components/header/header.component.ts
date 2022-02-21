import { Component, OnInit } from '@angular/core';
import { catchError, of } from 'rxjs';
import { IUser } from 'src/app/models/IUser';
import { AuthenticationService } from 'src/app/services/authentication/authentication.service';

@Component({
  selector: 'app-header',
  templateUrl: './header.component.html',
  styleUrls: ['./header.component.scss'],
})
export class HeaderComponent implements OnInit {
  public user = {
    email: 'sarina.mueller@hotmail.com',
    password: '8888',
  };
  private userConnected!: IUser;
  constructor(private authenticationService: AuthenticationService) {}

  ngOnInit(): void {
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
        });
      },
      (err) => console.error('Error: ', err)
    );
  }
}
