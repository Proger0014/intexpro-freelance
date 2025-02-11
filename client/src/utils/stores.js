import { autorun, set, toJS } from "mobx";

function autoSave(_this, name) {
    const storedJson = localStorage.getItem(name);

    if (storedJson) {
        set(_this, JSON.parse(storedJson));
    }

    autorun(() => {
        const value = toJS(_this);
        localStorage.setItem(name, JSON.stringify(value));
    });
}

export { autoSave };