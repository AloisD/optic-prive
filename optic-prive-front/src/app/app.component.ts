import { Component } from '@angular/core';
import { LanguageService } from './services/language/language.service';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.scss']
})
export class AppComponent {
  title = 'optic-prive-front';

  constructor(
    private languageService: LanguageService
  ) {
  }
}
