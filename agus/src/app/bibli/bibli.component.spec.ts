import { ComponentFixture, TestBed } from '@angular/core/testing';

import { BibliComponent } from './bibli.component';

describe('BibliComponent', () => {
  let component: BibliComponent;
  let fixture: ComponentFixture<BibliComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ BibliComponent ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(BibliComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
