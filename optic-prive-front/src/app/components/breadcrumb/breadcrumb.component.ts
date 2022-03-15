import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Params } from '@angular/router';

@Component({
  selector: 'app-breadcrumb',
  templateUrl: './breadcrumb.component.html',
  styleUrls: ['./breadcrumb.component.scss']
})
export class BreadcrumbComponent implements OnInit {
  segmentName: string | undefined;
  segmentTitle!: string;

  constructor(
    private activatedRoute: ActivatedRoute,
  ) {}

  ngOnInit(): void {
    this.activatedRoute.params.subscribe((params: Params) => {
      this.segmentName = params['name'];
      switch(this.segmentName) {
        case 'solaires':
          this.segmentTitle = 'Solaires';
          break;
        case 'sport':
          this.segmentTitle = 'Sport';
          break;
        case 'lumiere_bleue':
          this.segmentTitle = 'Lumière bleue';
          break;
        case 'vintage':
          this.segmentTitle = 'Vintage';
          break;
        case 'accessoires':
          this.segmentTitle = 'Accessoires';
          break;
      }
    });
  }
}

