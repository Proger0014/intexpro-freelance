import { ContentPaginatedLayout } from "../../layouts";
import { useStores } from "../../stores";
import SearchMain from "./SearchMain";

const ROUTE = "/search";

function handleChangePage(store, page) {
  store.fetchPage(page);
}

function SearchPage() {
  const { searchStore } = useStores();

  searchStore.fetchPage(1);

  return (
      <ContentPaginatedLayout 
          main={<SearchMain />} 
          titleTop="Заказы"
          handleChangePage={(page) => handleChangePage(searchStore, page)} />
  )
}

export { ROUTE };
export default SearchPage;