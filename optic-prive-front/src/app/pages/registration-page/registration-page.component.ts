import { Component, OnInit } from '@angular/core';
import { User } from 'src/app/models/User';


@Component({
  selector: 'app-registration-page',
  templateUrl: './registration-page.component.html',
  styleUrls: ['./registration-page.component.scss']
})
export class RegistrationPageComponent implements OnInit {

  model: User = new User();

  constructor() { }

  ngOnInit(): void {
  }

  onSubmit() {
    console.log(this.model);
 }
}
