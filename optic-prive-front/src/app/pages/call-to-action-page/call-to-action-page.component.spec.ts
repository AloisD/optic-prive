import { ComponentFixture, TestBed } from '@angular/core/testing';

import { CallToActionPageComponent } from './call-to-action-page.component';

describe('CallToActionPageComponent', () => {
  let component: CallToActionPageComponent;
  let fixture: ComponentFixture<CallToActionPageComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ CallToActionPageComponent ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(CallToActionPageComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
