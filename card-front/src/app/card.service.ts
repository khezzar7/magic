import { Injectable } from '@angular/core';
import {HttpClient} from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class CardService {

  private urlServer:string=
    'http://localhost:8000/';
    constructor(private http: HttpClient) { }

    getCards(){
      return this.http.get(this.urlServer + 'magic/json');
    }
}
