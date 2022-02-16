import { Component, OnInit } from '@angular/core';
import { catchError, of } from 'rxjs';
import { AuthenticationService } from 'src/app/services/authentication/authentication.service';

@Component({
  selector: 'app-header',
  templateUrl: './header.component.html',
  styleUrls: ['./header.component.scss'],
})
export class HeaderComponent implements OnInit {
  public user = {
    email: "hwalter@sawayn.com",
    password: "8888"
  };

  constructor(private authenticationService: AuthenticationService) {}

  ngOnInit(): void {
    this.authenticationService.products().subscribe(authenticationResponse => console.log)
  }

  login() {
    this.authenticationService.authentication(this.user)
    .subscribe(authenticationResponse => {
      console.log(authenticationResponse);
    }, err => console.log);
  }
}
