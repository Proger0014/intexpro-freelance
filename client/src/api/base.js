import axios from "axios";
import { API_URL } from "../config";

const base = axios.create({
  baseURL: API_URL,
  withCredentials: true
})

export default base;