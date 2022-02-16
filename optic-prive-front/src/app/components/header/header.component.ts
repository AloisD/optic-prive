import { Component, OnInit } from '@angular/core';
import { User } from 'src/app/models/User';

@Component({
  selector: 'app-header',
  templateUrl: './header.component.html',
  styleUrls: ['./header.component.scss'],
})
export class HeaderComponent implements OnInit {

  model: User = new User();

  constructor() {}

  ngOnInit(): void {
  }

  onSubmit() {
    console.log(this.model);
 }
}
