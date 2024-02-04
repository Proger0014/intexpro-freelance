import { HomeLayout } from "../../layouts";
import HomeBanner from "./HomeBanner";

const ROUTE = "/";

function HomePage() {
  return (
    <HomeLayout 
      banner={<HomeBanner w="50%" />}
      main={<></>} />
  )
}

export { ROUTE };

export default HomePage;