import { Component } from '@angular/core';
import {CardService} from './card.service';
interface Magic{
  id:number;
  image:string;
  title:string;
  body:string;
  edition:string;
  rarity:string;
  artist:string;

}
@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent {
  title = 'card-front';
  magics :Magic[]=[];

constructor(private cardService: CardService){
  this.cardService.getCards().subscribe((res:Magic[]) => {
    console.log(res);
    this.magics = res;
  })
  }

}
