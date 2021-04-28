import { Component, Input, OnInit } from '@angular/core';

@Component({
  selector: 'app-bibli',
  templateUrl: './bibli.component.html',
  styleUrls: ['./bibli.component.scss']
})
export class BibliComponent implements OnInit {

  @Input() filmNam?: string;
  @Input() filmGenre?: string;
  constructor() { }

  ngOnInit(): void {
  }

  getGenre(){
    return this.filmGenre;
  }

}
