import { rolesTranslate } from "../config";

function translateRole(roleName) {
  return rolesTranslate[roleName.toLowerCase()];
}

export { translateRole };