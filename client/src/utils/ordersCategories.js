import { ordersCategoriesTranslate } from "../config";

function translate(category) {
  return ordersCategoriesTranslate[category.toLowerCase()];
}

export { translate };