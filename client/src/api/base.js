import { API_URL } from "../config";
import axios from "axios";

const base = axios.create({
  baseURL: API_URL,
  withCredentials: true
})

export default base;