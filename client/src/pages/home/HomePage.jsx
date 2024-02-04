import { HomeLayout } from "../../layouts";
import HomeBanner from "./HomeBanner";
import HomeMain from "./HomeMain";

const ROUTE = "/";

function HomePage() {
  return (
    <HomeLayout 
      banner={<HomeBanner w="50%" pb="30%" />}
      main={<HomeMain pt="60px" />} />
  )
}

export { ROUTE };

export default HomePage;