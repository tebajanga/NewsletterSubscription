import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class AppService {
  private _url = 'http://localhost:8000/api';

  constructor(private http:HttpClient) { }
}
 