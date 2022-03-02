import { ComponentFixture, TestBed } from '@angular/core/testing';

import { ConceptPageComponent } from './concept-page.component';

describe('ConceptPageComponent', () => {
  let component: ConceptPageComponent;
  let fixture: ComponentFixture<ConceptPageComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ ConceptPageComponent ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(ConceptPageComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
