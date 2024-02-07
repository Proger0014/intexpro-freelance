import { ContentPaginatedLayout } from "../../layouts";
import SearchMain from "./SearchMain";

const ROUTE = "/search";

function SearchPage() {
    return (
        <ContentPaginatedLayout 
            main={<SearchMain />} 
            titleTop="Заказы" />
    )
}

export { ROUTE };
export default SearchPage;