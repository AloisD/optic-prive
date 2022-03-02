import { ComponentFixture, TestBed } from '@angular/core/testing';

import { TermsOfSalesPageComponent } from './terms-of-sales-page.component';

describe('TermsOfSalesPageComponent', () => {
  let component: TermsOfSalesPageComponent;
  let fixture: ComponentFixture<TermsOfSalesPageComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ TermsOfSalesPageComponent ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(TermsOfSalesPageComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
