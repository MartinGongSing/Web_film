import { Component } from '@angular/core';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.scss']
})
export class AppComponent {
  title = 'Mes Films App';
  F1 = 'Mamma Mia';
  F2 = 'Shrek';
  F3 = 'LOTR';
  isAuth = false;
  constructor(){
    setTimeout(
      () => {
        this.isAuth=true;
      }, 2000
  );
  }
  onAllumer(){
    console.log("Button pressed")
  }
}
